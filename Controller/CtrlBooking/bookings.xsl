<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : booking.xsl
    Created on : April 25, 2023, 12:12 AM
    Author     : vinnie chin
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>
    
    <xsl:template match="/">
        <html>
            <head>
                <title>Bookings</title>
                <style>
                    .booking-table {
                    width: 100%;
                    border-collapse: collapse;
                    font-family: Calibri, sans-serif;
                    }

                    .booking-table th, .booking-table td {
                    border: 1px solid #dcdcdc; 
                    padding: 8px;
                    text-align: left;
                    }

                    .booking-table th {
                    background-color: #f2f2f2; 
                    color: #333; 
                    font-weight: bold;
                    }

                    .booking-table tr:nth-child(even) {
                    background-color: #f9f

                </style>
            </head>
            <body>
                <h1>Bookings</h1>
                <table class="booking-table">
                    <tr>
                        <th>Booking No.</th>
                        <th>Ticket Number</th>
                        <th>Booking By</th>
                        <th>Customer Contact</th>
                        <th>Booking Date</th>
                        <th>Event Name</th>
                    </tr>
                    <xsl:apply-templates select="bookings/booking" />
                </table>
            </body>
        </html>
    </xsl:template>
    <xsl:template match="booking">
        <tr>
            <td class="booking-table-cell">
                <xsl:value-of select="bookingNo" />
            </td>
         
            <td class="booking-table-cell">
                <xsl:for-each select="bookingDetails/bookingDetail">
                    <xsl:value-of select="ticketNo" />
                    <xsl:if test="position() != last()">
                        <br />
                    </xsl:if>
                </xsl:for-each>
            </td>
            
            <td class="booking-table-cell">
                <xsl:value-of select="createdBy" />
            </td>
            <td class="booking-table-cell">
                <xsl:value-of select="customerPhone" />
            </td>
            <td class="booking-table-cell">
                <xsl:value-of select="substring(createdDate, 1, 10)" />
            </td>
            <td class="booking-table-cell">
                <xsl:value-of select="eventName" />
            </td>
        </tr>
    </xsl:template>

</xsl:stylesheet>

